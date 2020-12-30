<?php
/**
 *  UABB Interactive Banner 1 Module front-end CSS php file
 *
 *  @package UABB Interactive Banner 1 Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->overlay_background_color = uabb_theme_base_color( $settings->overlay_background_color );
$settings->overlay_background_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_background_color', true );

$settings->title_typography_color                  = UABB_Helper::uabb_colorpicker( $settings, 'title_typography_color' );
$settings->title_typography_title_background_color = UABB_Helper::uabb_colorpicker( $settings, 'title_typography_title_background_color', true );


$settings->desc_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_typography_color' );

?>

<?php
if ( '' !== $settings->icon ) {
	$imageicon_array = array(

		/* General Section */
		'image_type'              => 'icon',

		/* Icon Basics */
		'icon'                    => $settings->icon,
		'icon_size'               => $settings->icon_size,
		'icon_align'              => '',

		/* Image Basics */
		'photo_source'            => '',
		'photo'                   => '',
		'photo_url'               => '',
		'img_size'                => '',
		'img_align'               => '',
		'photo_src'               => '',

		/* Icon Style */
		'icon_style'              => 'simple',
		'icon_bg_size'            => '',
		'icon_border_style'       => '',
		'icon_border_width'       => '',
		'icon_bg_border_radius'   => '',

		/* Image Style */
		'image_style'             => '',
		'img_bg_size'             => '',
		'img_border_style'        => '',
		'img_border_width'        => '',
		'img_bg_border_radius'    => '',

		/* Preset Color variable new */
		'icon_color_preset'       => 'preset1',

		/* Icon Colors */
		'icon_color'              => $settings->icon_color,
		'icon_hover_color'        => '',
		'icon_bg_color'           => '',
		'icon_bg_hover_color'     => '',
		'icon_border_color'       => '',
		'icon_border_hover_color' => '',
		'icon_three_d'            => '',

		/* Image Colors */
		'img_bg_color'            => '',
		'img_bg_hover_color'      => '',
		'img_border_color'        => '',
		'img_border_hover_color'  => '',
	);

	/* CSS Render Function */
	FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );

}
if ( 'yes' === $settings->show_button ) {
	( '' !== $settings->button ) ? FLBuilder::render_module_css( 'uabb-button', $id, $settings->button ) : '';
}
?>

<?php if ( 'yes' === $settings->vertical_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-inner-mask {
		display: flex;
		flex-direction: column;
		height: 100%;
		justify-content: center;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block .uabb-back-icon {
		padding: 0;
	}
<?php } ?>

<?php
if ( 'custom' === $settings->banner_height_options ) {
	if ( '' !== $settings->banner_height ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-banner-block-custom-height.uabb-ib1-block {
			height: <?php echo esc_attr( $settings->banner_height ); ?>px;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-banner-block-custom-height.uabb-ib1-block img {
			height: 100%;
			width: auto;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-banner-block-custom-height .uabb-image-wrap {
			height: 100%;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-banner-block-custom-height .uabb-ib1-title {
			bottom: 0;
		}
		<?php
	}
} else {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block.uabb-banner-block-custom-height .uabb-ib1-title {
		bottom: 0;
	}
	<?php
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-description {
	color: <?php echo esc_attr( uabb_theme_text_color( $settings->desc_typography_color ) ); ?>;
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-description {
		<?php

		if ( 'Default' !== $settings->desc_typography_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->desc_typography_font_family );
		}
		?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_typography_font_size_unit ) && '' !== $settings->desc_typography_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->desc_typography_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->desc_typography_font_size_unit ) && '' === $settings->desc_typography_font_size_unit && isset( $settings->desc_typography_font_size['desktop'] ) && '' !== $settings->desc_typography_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->desc_typography_font_size['desktop'] ); ?>px;
			<?php } ?>  

		<?php if ( isset( $settings->desc_typography_font_size['desktop'] ) && '' === $settings->desc_typography_font_size['desktop'] && isset( $settings->desc_typography_line_height['desktop'] ) && '' !== $settings->desc_typography_line_height['desktop'] && '' === $settings->desc_typography_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_typography_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_typography_line_height_unit ) && '' !== $settings->desc_typography_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_typography_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->desc_typography_line_height_unit ) && '' === $settings->desc_typography_line_height_unit && isset( $settings->desc_typography_line_height['desktop'] ) && '' !== $settings->desc_typography_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_typography_line_height['desktop'] ); ?>px;
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
				'selector'     => ".fl-node-$id .uabb-ib1-description",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->title_typography_tag_selection ); ?>.uabb-ib1-title {
	<?php echo ( '' !== $settings->title_typography_color ) ? 'color: ' . esc_attr( $settings->title_typography_color ) : ''; ?>;
	background-color: <?php echo esc_attr( uabb_theme_base_color( $settings->title_typography_title_background_color ) ); ?>;
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->title_typography_tag_selection ); ?>.uabb-ib1-title { 
		<?php
		if ( 'Default' !== $settings->title_typography_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->title_typography_font_family );
		}
		?>

		<?php
		if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit ) && '' !== $settings->title_typography_font_size_unit ) {
			?>
			font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->title_typography_font_size_unit ) && '' === $settings->title_typography_font_size_unit && isset( $settings->title_typography_font_size['desktop'] ) && '' !== $settings->title_typography_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->title_typography_font_size['desktop'] ); ?>px;
			<?php } ?>

		<?php if ( isset( $settings->title_typography_font_size['desktop'] ) && '' === $settings->title_typography_font_size['desktop'] && isset( $settings->title_typography_line_height['desktop'] ) && '' !== $settings->title_typography_line_height['desktop'] && '' === $settings->title_typography_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->title_typography_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit ) && '' !== $settings->title_typography_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->title_typography_line_height_unit ) && '' === $settings->title_typography_line_height_unit && isset( $settings->title_typography_line_height['desktop'] ) && '' !== $settings->title_typography_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->title_typography_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->title_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->title_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->title_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->title_letter_spacing ); ?>px;
		<?php endif; ?>

	}
	<?php
} else {
	$title_tag = '';
	if ( class_exists( 'FLBuilderCSS' ) ) {
		$title_tag = $settings->title_typography_tag_selection;
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_font_typo',
				'selector'     => ".fl-node-$id $title_tag.uabb-ib1-title",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-bb-box .uabb-background {
	<?php
	echo 'background: ' . esc_attr( $settings->overlay_background_color ) . ';';
	?>
}

<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-description  {

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_font_size_unit_medium ) && '' !== $settings->desc_typography_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->desc_typography_font_size_unit_medium ) && '' === $settings->desc_typography_font_size_unit_medium && isset( $settings->desc_typography_font_size['medium'] ) && '' !== $settings->desc_typography_font_size['medium'] ) { ?> 
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size['medium'] ); ?>px;
				<?php } ?> 

				<?php if ( isset( $settings->desc_typography_font_size['medium'] ) && '' === $settings->desc_typography_font_size['medium'] && isset( $settings->desc_typography_line_height['medium'] ) && '' !== $settings->desc_typography_line_height['medium'] && '' === $settings->desc_typography_line_height_unit_medium && '' === $settings->desc_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_line_height_unit_medium ) && '' !== $settings->desc_typography_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height_unit_medium ); ?>em;
				<?php } elseif ( isset( $settings->desc_typography_line_height_unit_medium ) && '' === $settings->desc_typography_line_height_unit_medium && isset( $settings->desc_typography_line_height['medium'] ) && '' !== $settings->desc_typography_line_height['medium'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['medium'] ); ?>px;
				<?php } ?>

				?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->title_typography_tag_selection ); ?>.uabb-ib1-title {

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_medium ) && '' !== $settings->title_typography_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->title_typography_font_size_unit_medium ) && '' === $settings->title_typography_font_size_unit_medium && isset( $settings->title_typography_font_size['medium'] ) && '' !== $settings->title_typography_font_size['medium'] ) { ?> 
					font-size: <?php echo esc_attr( $settings->title_typography_font_size['medium'] ); ?>px;
				<?php } ?> 

				<?php if ( isset( $settings->title_typography_font_size['medium'] ) && '' === $settings->title_typography_font_size['medium'] && isset( $settings->title_typography_line_height['medium'] ) && '' !== $settings->title_typography_line_height['medium'] && '' === $settings->title_typography_line_height_unit_medium && '' === $settings->title_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit_medium ) && '' !== $settings->title_typography_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit_medium ); ?>em;
				<?php } elseif ( isset( $settings->title_typography_line_height_unit_medium ) && '' === $settings->title_typography_line_height_unit_medium && isset( $settings->title_typography_line_height['medium'] ) && '' !== $settings->title_typography_line_height['medium'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['medium'] ); ?>px;
				<?php } ?>

			}
		<?php } ?>
	}

	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-description {

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_font_size_unit_responsive ) && '' !== $settings->desc_typography_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size_unit_responsive ); ?>px;
				<?php } elseif ( isset( $settings->desc_typography_font_size_unit_responsive ) && '' === $settings->desc_typography_font_size_unit_responsive && isset( $settings->desc_typography_font_size['small'] ) && '' !== $settings->desc_typography_font_size['small'] ) { ?> 
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size['small'] ); ?>px;
				<?php } ?>   

				<?php if ( isset( $settings->desc_typography_font_size['small'] ) && '' === $settings->desc_typography_font_size['small'] && isset( $settings->desc_typography_line_height['small'] ) && '' !== $settings->desc_typography_line_height['small'] && '' === $settings->desc_typography_line_height_unit_responsive && '' === $settings->desc_typography_line_height_unit_medium && '' === $settings->desc_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['small'] ); ?>px;
					<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_line_height_unit_responsive ) && '' !== $settings->desc_typography_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->desc_typography_line_height_unit_responsive ) && '' === $settings->desc_typography_line_height_unit_responsive && isset( $settings->desc_typography_line_height['small'] ) && '' !== $settings->desc_typography_line_height['small'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['small'] ); ?>px;
				<?php } ?> 
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->title_typography_tag_selection ); ?>.uabb-ib1-title {

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_responsive ) && '' !== $settings->title_typography_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_responsive ); ?>px;
				<?php } elseif ( isset( $settings->title_typography_font_size_unit_responsive ) && '' === $settings->title_typography_font_size_unit_responsive && isset( $settings->title_typography_font_size['small'] ) && '' !== $settings->title_typography_font_size['small'] ) { ?> 
					font-size: <?php echo esc_attr( $settings->title_typography_font_size['small'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->title_typography_font_size['small'] ) && '' === $settings->title_typography_font_size['small'] && isset( $settings->title_typography_line_height['small'] ) && '' !== $settings->title_typography_line_height['small'] && '' === $settings->title_typography_line_height_unit_responsive && '' === $settings->title_typography_line_height_unit_medium && '' === $settings->title_typography_line_height_unit ) { ?>
							line-height: <?php echo esc_attr( $settings->title_typography_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit_responsive ) && '' !== $settings->title_typography_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->title_typography_line_height_unit_responsive ) && '' === $settings->title_typography_line_height_unit_responsive && isset( $settings->title_typography_line_height['small'] ) && '' !== $settings->title_typography_line_height['small'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['small'] ); ?>px;
				<?php } ?>

			}
		<?php } ?>
	}
	<?php
}
?>
