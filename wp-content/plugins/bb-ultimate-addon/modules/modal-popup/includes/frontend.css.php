<?php
/**
 *  UABB Modal Popup Module front-end CSS php file
 *
 *  @package UABB Modal Popup Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->content_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'content_bg_color' );
$settings->overlay_color    = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );

$settings->close_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'close_icon_color' );

$settings->icon_color       = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
$settings->icon_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );

$settings->text_color       = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'text_hover_color' );

$settings->title_color    = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
$settings->title_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'title_bg_color', true );

$settings->ct_content_color = UABB_Helper::uabb_colorpicker( $settings, 'ct_content_color' );

?>

.fl-node-<?php echo $id; ?> {
	width:100%;
}

.fl-node-<?php echo $id; ?> .uabb-modal-action-wrap {
	text-align: <?php echo $settings->all_align; ?>;
}



<?php
if ( 'button' == $settings->modal_on ) {
	if ( ! $version_bb_check ) {
		$btn_settings = array(

			/* General Section */
			'text'                       => $settings->btn_text,

			/* Link Section */
			'link'                       => '',
			'link_target'                => '',

			/* Style Section */
			'style'                      => $settings->btn_style,
			'border_size'                => $settings->btn_border_size,
			'transparent_button_options' => $settings->btn_transparent_button_options,
			'threed_button_options'      => $settings->btn_threed_button_options,
			'flat_button_options'        => $settings->btn_flat_button_options,
			'hover_attribute'            => $settings->hover_attribute,

			/* Colors */
			'bg_color'                   => $settings->btn_bg_color,
			'bg_hover_color'             => $settings->btn_bg_hover_color,
			'bg_color_opc'               => $settings->btn_bg_color_opc,
			'bg_hover_color_opc'         => $settings->btn_bg_hover_color_opc,
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
			'align'                      => $settings->btn_align,
			'mob_align'                  => $settings->btn_mob_align,
			'button_padding_dimension'   => ( isset( $settings->button_padding_dimension ) ) ? $settings->button_padding_dimension : '',
			'button_border_style'        => ( isset( $settings->button_border_style ) ) ? $settings->button_border_style : '',
			'button_border_width'        => ( isset( $settings->button_border_width ) ) ? $settings->button_border_width : '',
			'button_border_radius'       => ( isset( $settings->button_border_radius ) ) ? $settings->button_border_radius : '',
			'button_border_color'        => ( isset( $settings->button_border_color ) ) ? $settings->button_border_color : '',

			'border_hover_color'         => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',

		);
	} else {
			$btn_settings = array(

				/* General Section */
				'text'                       => $settings->btn_text,

				/* Link Section */
				'link'                       => '',
				'link_target'                => '',

				/* Style Section */
				'style'                      => $settings->btn_style,
				'border_size'                => $settings->btn_border_size,
				'transparent_button_options' => $settings->btn_transparent_button_options,
				'threed_button_options'      => $settings->btn_threed_button_options,
				'flat_button_options'        => $settings->btn_flat_button_options,
				'hover_attribute'            => $settings->hover_attribute,

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
				'align'                      => $settings->btn_align,
				'mob_align'                  => $settings->btn_mob_align,
				'button_padding_dimension'   => ( isset( $settings->button_padding_dimension ) ) ? $settings->button_padding_dimension : '',
				'button_border'              => ( isset( $settings->button_border ) ) ? $settings->button_border : '',
				'border_hover_color'         => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',
			);
	}
	/* CSS Render Function */
	FLBuilder::render_module_css( 'uabb-button', $id, $btn_settings );
	?>

	<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {

		<?php if ( 'Default' != $settings->btn_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->btn_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit ) && '' != $settings->btn_font_size_unit ) { ?>
			font-size: <?php echo $settings->btn_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->btn_font_size_unit ) && '' == $settings->btn_font_size_unit && isset( $settings->btn_font_size['desktop'] ) && '' != $settings->btn_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->btn_font_size['desktop'] ) && '' == $settings->btn_font_size['desktop'] && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] && '' == $settings->btn_line_height_unit ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit ) && '' != $settings->btn_line_height_unit ) { ?>
			line-height: <?php echo $settings->btn_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->btn_line_height_unit ) && '' == $settings->btn_line_height_unit && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->btn_transform ) : ?>
			ext-transform: <?php echo $settings->btn_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->btn_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->btn_letter_spacing; ?>px;
		<?php endif; ?>
	}
		<?php
} else {
	if ( 'default' === $settings->btn_style ) {
		$btn_typo = uabb_theme_button_typography( $settings->btn_typo );

		$settings->btn_typo            = ( array_key_exists( 'desktop', $btn_typo ) ) ? $btn_typo['desktop'] : $settings->btn_typo;
		$settings->btn_typo_medium     = ( array_key_exists( 'tablet', $btn_typo ) ) ? $btn_typo['tablet'] : $settings->btn_typo_medium;
		$settings->btn_typo_responsive = ( array_key_exists( 'mobile', $btn_typo ) ) ? $btn_typo['mobile'] : $settings->btn_typo_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'btn_typo',
					'selector'     => ".fl-node-$id .uabb-creative-button-wrap a,.fl-node-$id .uabb-creative-button-wrap a:visited",
				)
			);
	}
}
	?>

<?php } elseif ( 'text' == $settings->modal_on ) { ?>

.fl-node-<?php echo $id; ?> .uabb-modal-action {
	color: <?php echo $settings->text_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-modal-action:hover {
	color: <?php echo $settings->text_hover_color; ?>;
}

	<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-modal-action {
		<?php if ( 'Default' != $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) { ?>
			font-size: <?php echo $settings->font_size_unit; ?>px;
			<?php if ( '' == $settings->line_height_unit && '' != $settings->font_size_unit ) { ?>
				line-height: <?php echo $settings->font_size_unit + 2; ?>px;
			<?php } ?>
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
			line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
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
			ext-transform: <?php echo $settings->transform; ?>;
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
					'setting_name' => 'text_typo',
					'selector'     => ".fl-node-$id .uabb-modal-action",
				)
			);
	}
}
	?>

<?php } elseif ( 'icon' == $settings->modal_on ) { ?>

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-modal-action-wrap .uabb-modal-action .uabb-modal-icon {
	font-size: <?php echo $settings->icon_size; ?>px;
	color: <?php echo $settings->icon_color; ?>;
}

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-modal-action-wrap .uabb-modal-action:hover .uabb-modal-icon {
	color: <?php echo $settings->icon_hover_color; ?>;
}

<?php } elseif ( 'photo' == $settings->modal_on ) { ?>

.fl-node-<?php echo $id; ?> .uabb-modal-photo {
	width:<?php echo $settings->img_size; ?>px
}

<?php } ?>

/* Global Css */


<?php if ( 'icon' == $settings->close_source ) { ?>
	.uamodal-<?php echo $id; ?> .uabb-modal-close {
		font-size: <?php echo $settings->close_icon_size; ?>px;
	}
	.uamodal-<?php echo $id; ?> .uabb-close-icon {
		width: <?php echo $settings->close_icon_size; ?>px;
		height: <?php echo $settings->close_icon_size; ?>px;
		line-height: <?php echo $settings->close_icon_size; ?>px;
		font-size: <?php echo $settings->close_icon_size; ?>px;
		color: <?php echo $settings->close_icon_color; ?>;
	}
<?php } else { ?>
	.uamodal-<?php echo $id; ?> .uabb-modal-close,
	.uamodal-<?php echo $id; ?> .uabb-close-image {
		width: <?php echo ( '' != $settings->close_icon_size ) ? $settings->close_icon_size : '25'; ?>px;
		height: <?php echo ( '' != $settings->close_icon_size ) ? $settings->close_icon_size : '25'; ?>px;
	}
<?php } ?>

<?php if ( 'popup-edge-top-right' == $settings->icon_position ) { ?>
	.uamodal-<?php echo $id; ?> .uabb-modal-close {
		top: -<?php echo ( '' != $settings->close_icon_size ) ? intval( $settings->close_icon_size ) / 2 : '12.5'; ?>px;
		right: -<?php echo ( '' != $settings->close_icon_size ) ? intval( $settings->close_icon_size ) / 2 : '12.5'; ?>px;
		left: auto;
	}
<?php } elseif ( 'popup-edge-top-left' == $settings->icon_position ) { ?>
	.uamodal-<?php echo $id; ?> .uabb-modal-close {
		top: -<?php echo ( '' != $settings->close_icon_size ) ? intval( $settings->close_icon_size ) / 2 : '12.5'; ?>px;
		left: -<?php echo ( '' != $settings->close_icon_size ) ? intval( $settings->close_icon_size ) / 2 : '12.5'; ?>px;
		right: auto;
	}
<?php } ?>


.uamodal-<?php echo $id; ?> .uabb-content {
	background: <?php echo ( '' != $settings->content_bg_color ) ? $settings->content_bg_color : ''; ?>;
}

.uamodal-<?php echo $id; ?> .uabb-overlay {
	background: <?php echo ( '' != $settings->overlay_color ) ? $settings->overlay_color : ''; ?>;
}

.uamodal-<?php echo $id; ?> .uabb-modal-title-wrap {
	text-align: <?php echo $settings->title_alignment; ?>;

	<?php
	if ( 'yes' === $converted || isset( $settings->title_spacing_dimension_top ) && isset( $settings->title_spacing_dimension_bottom ) && isset( $settings->title_spacing_dimension_left ) && isset( $settings->title_spacing_dimension_right ) ) {
		if ( isset( $settings->title_spacing ) && '' == $settings->title_spacing ) {
			$settings->title_spacing_dimension_top    = '5';
			$settings->title_spacing_dimension_bottom = '5';
			$settings->title_spacing_dimension_left   = '25';
			$settings->title_spacing_dimension_right  = '25';
		}
		if ( isset( $settings->title_spacing_dimension_top ) ) {
			echo ( '' != $settings->title_spacing_dimension_top ) ? 'padding-top:' . $settings->title_spacing_dimension_top . 'px;' : 'padding-top: 5px;';
		}
		if ( isset( $settings->title_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->title_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->title_spacing_dimension_bottom . 'px;' : 'padding-bottom: 5px;';
		}
		if ( isset( $settings->title_spacing_dimension_left ) ) {
			echo ( '' != $settings->title_spacing_dimension_left ) ? 'padding-left:' . $settings->title_spacing_dimension_left . 'px;' : 'padding-left: 25px;';
		}
		if ( isset( $settings->title_spacing_dimension_right ) ) {
			echo ( '' != $settings->title_spacing_dimension_right ) ? 'padding-right:' . $settings->title_spacing_dimension_right . 'px;' : 'padding-right: 25px;';
		}
	} elseif ( isset( $settings->title_spacing ) && '' != $settings->title_spacing && isset( $settings->title_spacing_dimension_top ) && '' == $settings->title_spacing_dimension_top && isset( $settings->title_spacing_dimension_bottom ) && '' == $settings->title_spacing_dimension_bottom && isset( $settings->title_spacing_dimension_left ) && '' == $settings->title_spacing_dimension_left && isset( $settings->title_spacing_dimension_right ) && '' == $settings->title_spacing_dimension_right ) {
		echo $settings->title_spacing;
		?>
		;
	<?php } ?>

	<?php if ( '' != $settings->title_bg_color ) { ?>
	background: <?php echo $settings->title_bg_color; ?>;
	<?php } ?>
}

.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
	<?php
	if ( 'yes' === $converted || isset( $settings->modal_spacing_dimension_top ) && isset( $settings->modal_spacing_dimension_bottom ) && isset( $settings->modal_spacing_dimension_left ) && '' != $settings->modal_spacing_dimension_right ) {
		if ( isset( $settings->modal_spacing_dimension_top ) ) {
			echo ( '' != $settings->modal_spacing_dimension_top ) ? 'padding-top:' . $settings->modal_spacing_dimension_top . 'px;' : 'padding-top: 25px;';
		}
		if ( isset( $settings->modal_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->modal_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->modal_spacing_dimension_bottom . 'px;' : 'padding-bottom: 25px;';
		}
		if ( isset( $settings->modal_spacing_dimension_left ) ) {
			echo ( '' != $settings->modal_spacing_dimension_left ) ? 'padding-left:' . $settings->modal_spacing_dimension_left . 'px;' : 'padding-left: 25px;';
		}
		if ( isset( $settings->modal_spacing_dimension_right ) ) {
			echo ( '' != $settings->modal_spacing_dimension_right ) ? 'padding-right:' . $settings->modal_spacing_dimension_right . 'px;' : 'padding-right: 25px;';
		}
	} elseif ( isset( $settings->modal_spacing ) && '' != $settings->modal_spacing && isset( $settings->modal_spacing_dimension_top ) && '' == $settings->modal_spacing_dimension_top && isset( $settings->modal_spacing_dimension_bottom ) && '' == $settings->modal_spacing_dimension_bottom && isset( $settings->modal_spacing_dimension_left ) && '' == $settings->modal_spacing_dimension_left && isset( $settings->modal_spacing_dimension_right ) && '' == $settings->modal_spacing_dimension_right ) {
		echo $settings->modal_spacing;
		?>
		;
	<?php } ?>
}

	<?php if ( '' != $settings->modal_width && is_numeric( $settings->modal_width ) ) { ?>
		.uamodal-<?php echo $id; ?> .uabb-modal,
		.uamodal-<?php echo $id; ?> .uabb-content  {
				width: <?php echo $settings->modal_width; ?>px;
				max-width: 100%;
		}

		<?php $size = $module->get_width_height(); ?>
		<?php if ( 'youtube' == $settings->content_type || 'vimeo' == $settings->content_type ) { ?>
		.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
			width: <?php echo $size['width']; ?>px;
			max-width: 100%;
		}
		@media ( max-height: <?php echo $size['height'] . 'px'; ?> ) {
			.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
				height: auto;
			}
		}
		<?php } elseif ( 'iframe' == $settings->content_type ) { ?>
			.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
				height: <?php echo $settings->iframe_height; ?>px;
			}
		<?php } ?>
	<?php } elseif ( '' == $settings->modal_width ) { ?>
		.uamodal-<?php echo $id; ?> .uabb-modal,
		.uamodal-<?php echo $id; ?> .uabb-content  {
			width: 100%;
			max-width: 100%;
			<?php if ( 'youtube' == $settings->content_type || 'vimeo' == $settings->content_type ) { ?>
				height:100%;
				max-height: 100%;
			<?php } ?>
		}

		<?php if ( 'youtube' == $settings->content_type || 'vimeo' == $settings->content_type ) { ?>
		.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
			width: 100%;
			height: 100%;
			max-width: 100%;
			max-height: 100%;
		}
		<?php } elseif ( 'iframe' == $settings->content_type ) { ?>
			.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
				height: <?php echo $settings->iframe_height; ?>px;
			}
		<?php } ?>
	<?php } ?>

/* Responsive Center CSS */
<?php if ( '' != $settings->modal_width ) { ?>
	@media ( max-width: <?php echo ( intval( $settings->modal_width ) + 50 ) . 'px'; ?> ) {
	/*.uamodal-<?php echo $id; ?> .uabb-modal,*/
	.uamodal-<?php echo $id; ?> .uabb-content {
		width : 80%;
	}
}
<?php } ?>

/* Title Typography */

<?php if ( $settings->enable_title ) { ?>
		.uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
			<?php if ( '' != $settings->title_color ) { ?>
				color: <?php echo $settings->title_color; ?>;
			<?php } ?>
		}
	<?php if ( ! $version_bb_check ) { ?>
		.uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
			<?php if ( 'Default' != $settings->title_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->title_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->title_font_size_unit ) && '' != $settings->title_font_size_unit ) { ?>
				font-size: <?php echo $settings->title_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->title_font_size_unit ) && '' == $settings->title_font_size_unit && isset( $settings->title_font_size['desktop'] ) && '' != $settings->title_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->title_font_size['desktop']; ?>px;
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
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'title_font_typo',
					'selector'     => " .uamodal-$id .uabb-modal-title",
				)
			);
	}
}
	?>
<?php } ?>
/* End Title Typography */

/* Modal Content Typography */

<?php if ( 'content' == $settings->content_type ) { ?>
	.uamodal-<?php echo $id; ?> .uabb-modal-text {
		<?php if ( '' != $settings->ct_content_color ) : ?>
			color: <?php echo $settings->ct_content_color; ?>;
		<?php endif; ?>
	}
	<?php if ( ! $version_bb_check ) { ?>
		.uamodal-<?php echo $id; ?> .uabb-modal-text {
			<?php if ( 'Default' != $settings->ct_content_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->ct_content_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->ct_content_font_size_unit ) && '' != $settings->ct_content_font_size_unit ) { ?>
				font-size: <?php echo $settings->ct_content_font_size_unit; ?>px;
				<?php if ( '' == $settings->ct_content_line_height_unit && '' != $settings->ct_content_font_size_unit ) { ?>
					line-height: <?php echo $settings->ct_content_font_size_unit + 2; ?>px;
				<?php } ?>
			<?php } elseif ( isset( $settings->ct_content_font_size_unit ) && '' == $settings->ct_content_font_size_unit && isset( $settings->ct_content_font_size['desktop'] ) && '' != $settings->ct_content_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->ct_content_font_size['desktop']; ?>px;
				line-height: <?php echo $settings->ct_content_font_size['desktop'] + 2; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->ct_content_font_size['desktop'] ) && '' == $settings->ct_content_font_size['desktop'] && isset( $settings->ct_content_line_height['desktop'] ) && '' != $settings->ct_content_line_height['desktop'] && '' == $settings->ct_content_line_height_unit ) { ?>
				line-height: <?php echo $settings->ct_content_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->ct_content_line_height_unit ) && '' != $settings->ct_content_line_height_unit ) { ?>
				line-height: <?php echo $settings->ct_content_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->ct_content_line_height_unit ) && '' == $settings->ct_content_line_height_unit && isset( $settings->ct_content_line_height['desktop'] ) && '' != $settings->ct_content_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->ct_content_line_height['desktop']; ?>px;
			<?php } ?>
			<?php if ( 'none' != $settings->ct_transform ) : ?>
				text-transform: <?php echo $settings->ct_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->ct_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->ct_letter_spacing; ?>px;
			<?php endif; ?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'ct_content_font_typo',
					'selector'     => ".uamodal-$id .uabb-modal-text",
				)
			);
	}
}
	?>
<?php } ?>

/* End Modal Content Typography */
<?php if ( $global_settings->responsive_enabled ) { ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
		.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
		<?php
		if ( isset( $settings->modal_spacing_dimension_top_medium ) ) {
			echo ( '' != $settings->modal_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->modal_spacing_dimension_top_medium . 'px;' : '';
		}
		if ( isset( $settings->modal_spacing_dimension_bottom_medium ) ) {
			echo ( '' != $settings->modal_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->modal_spacing_dimension_bottom_medium . 'px;' : '';
		}
		if ( isset( $settings->modal_spacing_dimension_left_medium ) ) {
			echo ( '' != $settings->modal_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->modal_spacing_dimension_left_medium . 'px;' : '';
		}
		if ( isset( $settings->modal_spacing_dimension_right_medium ) ) {
			echo ( '' != $settings->modal_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->modal_spacing_dimension_right_medium . 'px;' : '';
		}
		?>
		}
		.uamodal-<?php echo $id; ?> .uabb-modal-title-wrap {
		<?php
		if ( isset( $settings->title_spacing_dimension_top_medium ) ) {
			echo ( '' != $settings->title_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->title_spacing_dimension_top_medium . 'px;' : '';
		}
		if ( isset( $settings->title_spacing_dimension_bottom_medium ) ) {
			echo ( '' != $settings->title_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->title_spacing_dimension_bottom_medium . 'px;' : '';
		}
		if ( isset( $settings->title_spacing_dimension_left_medium ) ) {
			echo ( '' != $settings->title_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->title_spacing_dimension_left_medium . 'px;' : '';
		}
		if ( isset( $settings->title_spacing_dimension_right_medium ) ) {
			echo ( '' != $settings->title_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->title_spacing_dimension_right_medium . 'px;' : '';
		}
		?>
		}
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
		.uamodal-<?php echo $id; ?> .uabb-modal-content-data {
			<?php
			if ( isset( $settings->modal_spacing_dimension_top_responsive ) ) {
				echo ( '' != $settings->modal_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->modal_spacing_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->modal_spacing_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->modal_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->modal_spacing_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->modal_spacing_dimension_left_responsive ) ) {
				echo ( '' != $settings->modal_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->modal_spacing_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->modal_spacing_dimension_right_responsive ) ) {
				echo ( '' != $settings->modal_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->modal_spacing_dimension_right_responsive . 'px;' : '';
			}
			?>
		}
		.uamodal-<?php echo $id; ?> .uabb-modal-title-wrap {
		<?php
		if ( isset( $settings->title_spacing_dimension_top_responsive ) ) {
			echo ( '' != $settings->title_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->title_spacing_dimension_top_responsive . 'px;' : '';
		}
		if ( isset( $settings->title_spacing_dimension_bottom_responsive ) ) {
			echo ( '' != $settings->title_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->title_spacing_dimension_bottom_responsive . 'px;' : '';
		}
		if ( isset( $settings->title_spacing_dimension_left_responsive ) ) {
			echo ( '' != $settings->title_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->title_spacing_dimension_left_responsive . 'px;' : '';
		}
		if ( isset( $settings->title_spacing_dimension_right_responsive ) ) {
			echo ( '' != $settings->title_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->title_spacing_dimension_right_responsive . 'px;' : '';
		}
		?>
		}
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
	<?php
	if ( $global_settings->responsive_enabled ) { // Global Setting If started.
		if ( isset( $settings->btn_font_size_unit_medium ) || isset( $settings->btn_line_height_unit_medium ) || isset( $settings->btn_line_height_unit ) || isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height_unit ) || isset( $settings->ct_content_font_size_unit_medium ) || isset( $settings->ct_content_line_height_unit_medium ) || isset( $settings->ct_content_line_height_unit ) || isset( $settings->title_font_size_unit_medium ) || isset( $settings->title_line_height_unit_medium ) || isset( $settings->title_line_height_unit ) || isset( $settings->font_size['medium'] ) || isset( $settings->line_height['medium'] ) || isset( $settings->btn_font_size['medium'] ) || isset( $settings->btn_line_height['medium'] ) || isset( $settings->ct_content_font_size['medium'] ) || isset( $settings->ct_content_line_height['medium'] ) || isset( $settings->title_font_size['medium'] ) || isset( $settings->title_line_height['medium'] ) ) {
			/* Medium Breakpoint media query */
			?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

				<?php if ( 'button' == $settings->modal_on ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
						.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
							<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_medium ) && '' != $settings->btn_font_size_unit_medium ) { ?>
								font-size: <?php echo $settings->btn_font_size_unit_medium; ?>px;
								<?php if ( '' == $settings->btn_line_height_unit_medium && '' != $settings->btn_font_size_unit_medium ) { ?>
									line-height: <?php $settings->btn_font_size_unit_medium + 2; ?>px;
								<?php } ?>
							<?php } elseif ( isset( $settings->btn_font_size_unit_medium ) && '' == $settings->btn_font_size_unit_medium && isset( $settings->btn_font_size['medium'] ) && '' != $settings->btn_font_size['medium'] ) { ?>
								font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
								line-height: <?php $settings->btn_font_size['medium'] + 2; ?>px;
							<?php } ?>

							<?php if ( isset( $settings->btn_font_size['medium'] ) && '' == $settings->btn_font_size['medium'] && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] && '' == $settings->btn_line_height_unit_medium && '' == $settings->btn_line_height_unit ) { ?>
								line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_medium ) && '' != $settings->btn_line_height_unit_medium ) { ?>
								line-height: <?php echo $settings->btn_line_height_unit_medium; ?>em;
							<?php } elseif ( isset( $settings->btn_line_height_unit_medium ) && '' == $settings->btn_line_height_unit_medium && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] ) { ?>
								line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
							<?php } ?>
						}
					<?php } ?>
				<?php } ?>
				<?php if ( 'text' == $settings->modal_on ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo $id; ?> .uabb-modal-action {
							<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) { ?>
								font-size: <?php echo $settings->font_size_unit_medium; ?>px;
							<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' == $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' != $settings->font_size['medium'] ) { ?>
								font-size: <?php echo $settings->font_size['medium']; ?>px;
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
					<?php } ?>
				<?php } ?>

				<?php if ( 'content' == $settings->content_type ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.uamodal-<?php echo $id; ?> .uabb-modal-text {
							<?php if ( 'yes' === $converted || isset( $settings->ct_content_font_size_unit_medium ) && '' != $settings->ct_content_font_size_unit_medium ) { ?>
								font-size: <?php echo $settings->ct_content_font_size_unit_medium; ?>px;
							<?php } elseif ( isset( $settings->ct_content_font_size_unit_medium ) && '' == $settings->ct_content_font_size_unit_medium && isset( $settings->ct_content_font_size['medium'] ) && '' != $settings->ct_content_font_size['medium'] ) { ?>
								font-size: <?php echo $settings->ct_content_font_size['medium']; ?>px;
							<?php } ?>

							<?php if ( isset( $settings->ct_content_font_size['medium'] ) && '' == $settings->ct_content_font_size['medium'] && isset( $settings->ct_content_line_height['medium'] ) && '' != $settings->ct_content_line_height['medium'] && '' == $settings->ct_content_line_height_unit_medium && '' == $settings->ct_content_line_height_unit ) { ?>
								line-height: <?php echo $settings->ct_content_line_height['medium']; ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->ct_content_line_height_unit_medium ) && '' != $settings->ct_content_line_height_unit_medium ) { ?>
								line-height: <?php echo $settings->ct_content_line_height_unit_medium; ?>em;
							<?php } elseif ( isset( $settings->ct_content_line_height_unit_medium ) && '' == $settings->ct_content_line_height_unit_medium && isset( $settings->ct_content_line_height['medium'] ) && '' != $settings->ct_content_line_height['medium'] ) { ?>
								line-height: <?php echo $settings->ct_content_line_height['medium']; ?>px;
							<?php } ?>
						}
					<?php } ?>
				<?php } ?>

				<?php if ( $settings->enable_title ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
							<?php if ( 'yes' === $converted || isset( $settings->title_font_size_unit_medium ) && '' != $settings->title_font_size_unit_medium ) { ?>
								font-size: <?php echo $settings->title_font_size_unit_medium; ?>px;
								<?php if ( '' == $settings->title_line_height_unit_medium && '' != $settings->title_font_size_unit_medium ) { ?>
									line-height: <?php echo $settings->title_font_size_unit_medium + 2; ?>px;
								<?php } ?>
							<?php } elseif ( isset( $settings->title_font_size_unit_medium ) && '' == $settings->title_font_size_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
								font-size: <?php echo $settings->title_font_size['medium']; ?>px;
								line-height: <?php echo $settings->title_font_size['medium'] + 2; ?>px;
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
			}
			<?php
		}
		if ( isset( $settings->btn_font_size_unit_medium ) || isset( $settings->btn_line_height_unit_responsive ) || isset( $settings->btn_line_height_unit_medium ) || isset( $settings->btn_line_height_unit ) || isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_responsive ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height_unit ) || isset( $settings->ct_content_font_size_unit_medium ) || isset( $settings->ct_content_line_height_unit_responsive ) || isset( $settings->ct_content_line_height_unit_medium ) || isset( $settings->ct_content_line_height_unit ) || isset( $settings->title_font_size_unit_medium ) || isset( $settings->title_line_height_unit_responsive ) || isset( $settings->title_line_height_unit_medium ) || isset( $settings->title_line_height_unit ) || isset( $settings->font_size['small'] ) || isset( $settings->line_height['small'] ) || isset( $settings->btn_font_size['small'] ) || isset( $settings->btn_line_height['small'] ) || isset( $settings->ct_content_font_size['small'] ) || isset( $settings->ct_content_line_height['small'] ) || isset( $settings->title_font_size['small'] ) || isset( $settings->title_line_height['small'] ) ) {
			/* Small Breakpoint media query */
			?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
				<?php if ( 'button' == $settings->modal_on ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
						.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {

							<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_responsive ) && '' != $settings->btn_font_size_unit_responsive ) { ?>
								font-size: <?php echo $settings->btn_font_size_unit_responsive; ?>px;
								<?php if ( '' == $settings->btn_line_height_unit_responsive && '' != $settings->btn_font_size_unit_responsive ) { ?>
									line-height: <?php echo $settings->btn_font_size_unit_responsive + 2; ?>px;
								<?php } ?>
							<?php } elseif ( isset( $settings->btn_font_size_unit_responsive ) && '' == $settings->btn_font_size_unit_responsive && isset( $settings->btn_font_size['small'] ) && '' != $settings->btn_font_size['small'] ) { ?>
								font-size: <?php echo $settings->btn_font_size['small']; ?>px;
								line-height: <?php echo $settings->btn_font_size['small'] + 2; ?>px;
							<?php } ?>

							<?php if ( isset( $settings->btn_font_size['small'] ) && '' == $settings->btn_font_size['small'] && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] && '' == $settings->btn_line_height_unit_responsive && '' == $settings->btn_line_height_unit_medium && '' == $settings->btn_line_height_unit ) { ?>
								line-height: <?php echo $settings->btn_line_height['small']; ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_responsive ) && '' != $settings->btn_line_height_unit_responsive ) { ?>
								line-height: <?php echo $settings->btn_line_height_unit_responsive; ?>em;
							<?php } elseif ( isset( $settings->btn_line_height_unit_responsive ) && '' == $settings->btn_line_height_unit_responsive && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] ) { ?>
								line-height: <?php echo $settings->btn_line_height['small']; ?>px;
							<?php } ?>
						}
					<?php } ?>
				<?php } ?>

				<?php if ( 'text' == $settings->modal_on ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo $id; ?> .uabb-modal-action {
							<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) { ?>
								font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
								<?php if ( '' == $settings->line_height_unit_responsive && '' != $settings->font_size_unit_responsive ) { ?>
									line-height: <?php echo $settings->font_size_unit_responsive + 2; ?>px;
								<?php } ?>
							<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' == $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] ) { ?>
								font-size: <?php echo $settings->font_size['small']; ?>px;
								line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
							<?php } ?>

							<?php if ( isset( $settings->line_height['small'] ) && '' == $settings->line_height['small'] && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
							line-height: <?php echo $settings->line_height['small']; ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) { ?>
								line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
							<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
								line-height: <?php echo $settings->line_height['small']; ?>px;
							<?php } ?>
						}
					<?php } ?>
				<?php } ?>

				<?php if ( 'content' == $settings->content_type ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.uamodal-<?php echo $id; ?> .uabb-modal-text {
							<?php if ( 'yes' === $converted || isset( $settings->ct_content_font_size_unit_responsive ) && '' != $settings->ct_content_font_size_unit_responsive ) { ?>
								font-size: <?php echo $settings->ct_content_font_size_unit_responsive; ?>px;
								<?php if ( '' == $settings->ct_content_line_height_unit_responsive && '' != $settings->ct_content_font_size_unit_responsive ) { ?>
									line-height: <?php echo $settings->ct_content_font_size_unit_responsive + 2; ?>px;
								<?php } ?>
							<?php } elseif ( isset( $settings->ct_content_font_size_unit_responsive ) && '' == $settings->ct_content_font_size_unit_responsive && isset( $settings->ct_content_font_size['small'] ) && '' != $settings->ct_content_font_size['small'] ) { ?>
								font-size: <?php echo $settings->ct_content_font_size['small']; ?>px;
								line-height: <?php echo $settings->ct_content_font_size['small'] + 2; ?>px;
							<?php } ?>

							<?php if ( isset( $settings->ct_content_font_size['small'] ) && '' == $settings->ct_content_font_size['small'] && isset( $settings->ct_content_line_height['small'] ) && '' != $settings->ct_content_line_height['small'] && '' == $settings->ct_content_line_height_unit_responsive && '' == $settings->ct_content_line_height_unit_medium && '' == $settings->ct_content_line_height_unit ) { ?>
									line-height: <?php echo $settings->ct_content_line_height['small']; ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->ct_content_line_height_unit_responsive ) && '' != $settings->ct_content_line_height_unit_responsive ) { ?>
								line-height: <?php echo $settings->ct_content_line_height_unit_responsive; ?>em;
							<?php } elseif ( isset( $settings->ct_content_line_height_unit_responsive ) && '' == $settings->ct_content_line_height_unit_responsive && isset( $settings->ct_content_line_height['small'] ) && '' != $settings->ct_content_line_height['small'] ) { ?>
								line-height: <?php echo $settings->ct_content_line_height['small']; ?>px;
							<?php } ?>
						}
					<?php } ?>
				<?php } ?>

				<?php if ( $settings->enable_title ) { ?>
					<?php if ( ! $version_bb_check ) { ?>
						.uamodal-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-modal-title {
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
			}
			<?php
		}
	}
	?>
<?php } ?>
.uamodal-<?php echo $id; ?> .uabb-loader::before{
	border: 3px solid rgba( 0,0,0,0.8 );
	border-left-color: transparent;
	border-right-color: transparent;
}

