<?php
/**
 *  UABB FAQ's front-end CSS php file
 *
 *  @package UABB FAQ's
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;


$settings->faq_title_color       = UABB_Helper::uabb_colorpicker( $settings, 'faq_title_color' );
$settings->faq_title_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'faq_title_hover_color' );

$settings->faq_title_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'faq_title_bg_color', true );
$settings->faq_title_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'faq_title_bg_hover_color', true );
$settings->icon_color               = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
$settings->icon_hover_color         = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );
$settings->answers_color            = UABB_Helper::uabb_colorpicker( $settings, 'answers_color' );
$settings->answers_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'answers_bg_color', true );
$settings->style_background_col     = UABB_Helper::uabb_colorpicker( $settings, 'style_background_col', true );
$settings->faq_item_margin          = ( '' !== esc_attr( $settings->faq_item_margin ) ) ? esc_attr( $settings->faq_item_margin ) : '10';
$settings->icon_size                = ( '' !== esc_attr( $settings->icon_size ) ) ? esc_attr( $settings->icon_size ) : '16';

if ( ! $version_bb_check ) {
	$settings->content_border_color = UABB_Helper::uabb_colorpicker( $settings, 'content_border_color' );
	$settings->title_border_color   = UABB_Helper::uabb_colorpicker( $settings, 'title_border_color' );
}
?>
<?php if ( isset( $settings->style_background_col ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb__faq-layout-grid.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item-wrap,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb__faq-layout-accordion.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item {
		<?php echo ( '' !== esc_attr( $settings->style_background_col ) ) ? 'background:' . esc_attr( $settings->style_background_col ) . ';' : ''; ?>
	}
<?php } ?>
<?php if ( isset( $settings->column_gap ) ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq__layout-grid .uabb-faq-item {
		<?php
			echo ( '' !== esc_attr( $settings->column_gap ) ) ? 'padding-right:calc(' . esc_attr( $settings->column_gap ) / 2 . 'px);' : 'padding-right:calc( 10px/2 );';
			echo ( '' !== esc_attr( $settings->column_gap ) ) ? 'padding-left:calc(' . esc_attr( $settings->column_gap ) / 2 . 'px);' : 'padding-left:calc( 10px/2 );';
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-wrap {

		<?php echo ( '' !== esc_attr( $settings->column_gap ) ) ? 'margin-left:calc(-' . esc_attr( $settings->column_gap ) / 2 . 'px );' : ''; ?>
		<?php echo ( '' !== esc_attr( $settings->column_gap ) ) ? 'margin-right:calc(-' . esc_attr( $settings->column_gap ) / 2 . 'px );' : ''; ?>
	}
<?php } ?>
<?php if ( isset( $settings->row_gap ) && 'grid' === $settings->faq_layout ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item {
		<?php
		if ( isset( $settings->row_gap ) ) {
			echo ( '' !== esc_attr( $settings->row_gap ) ) ? 'padding-bottom:' . esc_attr( $settings->row_gap ) . 'px;' : '';
		}
		?>
	}
<?php } ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item {
	<?php if ( is_numeric( $settings->faq_item_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->faq_item_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions<?php echo esc_attr( $id ); ?> {

	<?php
	if ( isset( $settings->faq_item_padding_top ) ) {
		echo ( '' !== esc_attr( $settings->faq_item_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->faq_item_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->faq_item_padding_right ) ) {
		echo ( '' !== esc_attr( $settings->faq_item_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->faq_item_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->faq_item_padding_bottom ) ) {
		echo ( '' !== esc_attr( $settings->faq_item_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->faq_item_padding_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->faq_item_padding_left ) ) {
		echo ( '' !== esc_attr( $settings->faq_item_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->faq_item_padding_left ) . 'px;' : '';
	}
	?>
	<?php if ( isset( $settings->faq_title_bg_color ) && 'accordion_style' === $settings->layout_style ) { ?>
		background: <?php echo esc_attr( $settings->faq_title_bg_color ); ?>;
	<?php } ?>
	<?php if ( '' === esc_attr( $settings->open_icon ) && '' === esc_attr( $settings->close_icon ) ) : ?>
		width: 100%;
	<?php endif; ?>
}
<?php if ( 'accordion_style' === $settings->layout_style ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq__layout-grid .uabb-faq-questions,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions {
			<?php
			if ( isset( $settings->title_border ) ) {
				echo ( '' !== esc_attr( $settings->title_border ) ) ? 'border-width:' . esc_attr( $settings->title_border ) . 'px;' : '';
			}
			if ( isset( $settings->title_border_type ) ) {
				echo ( '' !== esc_attr( $settings->title_border_type ) ) ? 'border-style:' . esc_attr( $settings->title_border_type ) . ';' : '';
			}
			if ( isset( $settings->title_border_color ) ) {
				echo ( '' !== esc_attr( $settings->title_border_color ) ) ? 'border-color:' . esc_attr( $settings->title_border_color ) . ';' : '';
			}
			if ( isset( $settings->title_border_radius ) ) {
				echo ( '' !== esc_attr( $settings->title_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->title_border_radius ) . 'px;' : '';
			}
			?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'faq_border_param',
					'selector'     => ".fl-node-$id .uabb-faq-questions,.fl-node-$id .uabb-faq__layout-grid .uabb-faq-questions",
				)
			);
		}
	}
}
?>
<?php if ( 'box_style' === $settings->layout_style ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb__faq-layout-grid.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb__faq-layout-accordion.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item {
			<?php
			if ( isset( $settings->style_borde ) ) {
				echo ( '' !== esc_attr( $settings->style_border ) ) ? 'border-width:' . esc_attr( $settings->style_border ) . 'px;' : '';
			}
			if ( isset( $settings->style_border_type ) ) {
				echo ( '' !== esc_attr( $settings->style_border_type ) ) ? 'border-style:' . esc_attr( $settings->style_border_type ) . ';' : '';
			}
			if ( isset( $settings->style_border_color ) ) {
				echo ( '' !== esc_attr( $settings->style_border_color ) ) ? 'border-color:' . esc_attr( $settings->style_border_color ) . ';' : '';
			}
			if ( isset( $settings->style_border_radius ) ) {
				echo ( '' !== esc_attr( $settings->style_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->style_border_radius ) . 'px;' : '';
			}
			?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'style_border_param',
					'selector'     => ".fl-node-$id .uabb__faq-layout-grid.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item-wrap,.fl-node-$id .uabb__faq-layout-accordion.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item",
				)
			);
		}
	}
}
?>

<?php if ( '' === esc_attr( $settings->open_icon ) && '' === esc_attr( $settings->close_icon ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-adv-before-text .uabb-faq-question-label {
		padding-left: 0;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-adv-after-text .uabb-faq-question-label {
		padding-right: 0;
	}
<?php endif; ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-module .uabb-faq-question-label {
		text-align: <?php echo esc_attr( $settings->title_align ); ?>;
	}
	<?php
}
if ( isset( $settings->faq_title_color ) && ! empty( $settings->faq_title_color ) ) {
	?>
	/* Color */
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-module .uabb-faq-question-label {
		color: <?php echo esc_attr( $settings->faq_title_color ); ?>;
	}
<?php } if ( isset( $settings->icon_color ) && ! empty( $settings->icon_color ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions .uabb-faq-button-icon {
		color: <?php echo esc_attr( $settings->icon_color ); ?>;
	}
<?php } ?>
/* Content css */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content<?php echo esc_attr( $id ); ?> {
	<?php
	if ( isset( $settings->answers_bg_color ) && 'accordion_style' === $settings->layout_style ) {
		echo ( '' !== esc_attr( $settings->answers_bg_color ) ) ? 'background:' . esc_attr( $settings->answers_bg_color ) . ';' : '';
	}
	if ( isset( $settings->answers_padding_top ) ) {
		echo ( '' !== esc_attr( $settings->answers_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->answers_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->answers_padding_right ) ) {
		echo ( '' !== esc_attr( $settings->answers_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->answers_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->answers_padding_bottom ) ) {
		echo ( '' !== esc_attr( $settings->answers_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->answers_padding_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->answers_padding_left ) ) {
		echo ( '' !== esc_attr( $settings->answers_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->answers_padding_left ) . 'px;' : '';
	}
	?>
}
<?php if ( 'accordion_style' === $settings->layout_style ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-adv-accordion-content<?php echo esc_attr( $id ); ?> {
			<?php
			if ( isset( $settings->content_border ) ) {
				echo ( '' !== esc_attr( $settings->content_border ) ) ? 'border-width:' . esc_attr( $settings->content_border ) . 'px;' : '';
			}
			if ( isset( $settings->content_border_type ) ) {
				echo ( '' !== esc_attr( $settings->content_border_type ) ) ? 'border-style:' . esc_attr( $settings->content_border_type ) . ';' : '';
			}
			if ( isset( $settings->content_border_color ) ) {
				echo ( '' !== esc_attr( $settings->content_border_color ) ) ? 'border-color:' . esc_attr( $settings->content_border_color ) . ';' : '';
			}
			if ( isset( $settings->content_border_radius ) ) {
				echo ( '' !== esc_attr( $settings->content_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->content_border_radius ) . 'px;' : '';
			}
			if ( isset( $settings->content_align ) ) {
				echo ( '' !== esc_attr( $settings->content_align ) ) ? 'text-align:' . esc_attr( $settings->content_align ) . 'px;' : '';
			}
			?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'answers_border',
					'selector'     => ".fl-node-$id .uabb-faq-content$id,.fl-node-$id .uabb-faq-content",
				)
			);
		}
	}
}
if ( isset( $settings->answers_color ) && ! empty( $settings->answers_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content<?php echo esc_attr( $id ); ?> {
		color: <?php echo esc_attr( $settings->answers_color ); ?>;
	}
	<?php
}
if ( isset( $settings->faq_title_hover_color ) && ! empty( $settings->faq_title_hover_color ) ) {
	?>
	/* Hover State */
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions:hover .uabb-faq-question-label,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item-active > .uabb-faq-questions .uabb-faq-question-label {
		color: <?php echo esc_attr( $settings->faq_title_hover_color ); ?>;
	}
<?php } if ( isset( $settings->faq_title_bg_hover_color ) && ! empty( $settings->faq_title_bg_hover_color ) && 'accordion_style' === $settings->layout_style ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item-active > .uabb-faq-questions {
		background: <?php echo esc_attr( $settings->faq_title_bg_hover_color ); ?>;
	}
	<?php
}
if ( isset( $settings->icon_hover_color ) && ! empty( $settings->icon_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions:hover .uabb-faq-button-icon,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item-active > .uabb-faq-questions .uabb-faq-button-icon {
		color: <?php echo esc_attr( $settings->icon_hover_color ); ?>;
	}
<?php } ?>
/* Typography */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions<?php echo esc_attr( $id ); ?> .uabb-faq-question-label {
		<?php if ( 'Default' !== esc_attr( $settings->font_family['family'] ) ) : ?>
			<?php UABB_Helper::uabb_font_css( esc_attr( $settings->font_family ) ); ?>
		<?php endif; ?>

		<?php if ( isset( $settings->font_size_unit ) && '' !== esc_attr( $settings->font_size_unit ) ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size_unit ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->line_height_unit ) && '' !== esc_attr( $settings->line_height_unit ) ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height_unit ); ?>em;
		<?php } ?>

			<?php if ( 'none' !== esc_attr( $settings->transform ) ) : ?>
				text-transform: <?php echo esc_attr( $settings->transform ); ?>;
			<?php endif; ?>

			<?php if ( '' !== esc_attr( $settings->letter_spacing ) ) : ?>
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
				'selector'     => ".fl-node-$id .uabb-faq-questions$id .uabb-faq-question-label",
			)
		);
	}
}
if ( isset( $settings->icon_size ) && ! empty( $settings->icon_size ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions .uabb-faq-button-icon,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions .uabb-faq-button-icon.dashicons:before {
		font-size: <?php echo esc_attr( $settings->icon_size ); ?>px;
		line-height: <?php echo esc_attr( $settings->icon_size ) + 2; ?>px;
		height: <?php echo esc_attr( $settings->icon_size ) + 2; ?>px;
		width: <?php echo esc_attr( $settings->icon_size ) + 2; ?>px;
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content {
		<?php if ( 'Default' !== esc_attr( $settings->content_font_family['family'] ) ) : ?>
			<?php UABB_Helper::uabb_font_css( esc_attr( $settings->content_font_family ) ); ?>
		<?php endif; ?>

		<?php if ( isset( $settings->content_font_size_unit ) && '' !== esc_attr( $settings->content_font_size_unit ) ) { ?>
			font-size: <?php echo esc_attr( $settings->content_font_size_unit ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->content_line_height_unit ) && '' !== esc_attr( $settings->content_line_height_unit ) ) { ?>
			line-height: <?php echo esc_attr( $settings->content_line_height_unit ); ?>em;
		<?php } ?>

		<?php if ( 'none' !== esc_attr( $settings->content_transform ) ) : ?>
			text-transform: <?php echo esc_attr( $settings->content_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== esc_attr( $settings->content_letter_spacing ) ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->content_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'content_font_typo',
				'selector'     => ".fl-node-$id .uabb-faq-content",
			)
		);
	}
}
?>
<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

		<?php if ( isset( $settings->row_gap_medium ) && 'accordion_style' === $settings->layout_style ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item {
				<?php
				if ( isset( $settings->row_gap_medium ) ) {
					echo ( '' !== esc_attr( $settings->row_gap_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->row_gap_medium ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->column_gap_medium ) ) { ?>

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq__layout-grid .uabb-faq-item {
				<?php
					echo ( '' !== esc_attr( $settings->column_gap_medium ) ) ? 'padding-right:calc(' . esc_attr( $settings->column_gap_medium ) / 2 . 'px);' : 'padding-right:calc( 10px/2 );';
					echo ( '' !== esc_attr( $settings->column_gap_medium ) ) ? 'padding-left:calc(' . esc_attr( $settings->column_gap_medium ) / 2 . 'px);' : 'padding-left:calc( 10px/2 );';
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-wrap {

				<?php echo ( '' !== esc_attr( $settings->column_gap_medium ) ) ? 'margin-left:calc(-' . esc_attr( $settings->column_gap_medium ) / 2 . 'px );' : ''; ?>
				<?php echo ( '' !== esc_attr( $settings->column_gap_medium ) ) ? 'margin-right:calc(-' . esc_attr( $settings->column_gap_medium ) / 2 . 'px );' : ''; ?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content<?php echo esc_attr( $id ); ?> {
			<?php
			if ( isset( $settings->answers_padding_top_medium ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_top_medium ) ) ? 'padding-top:' . esc_attr( $settings->answers_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->answers_padding_bottom_medium ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_bottom_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->answers_padding_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->answers_padding_left_medium ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_left_medium ) ) ? 'padding-left:' . esc_attr( $settings->answers_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->answers_padding_right_medium ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_right_medium ) ) ? 'padding-right:' . esc_attr( $settings->answers_padding_right_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions<?php echo esc_attr( $id ); ?> {
			<?php
			if ( isset( $settings->faq_item_padding_top_medium ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_top_medium ) ) ? 'padding-top:' . esc_attr( $settings->faq_item_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->faq_item_padding_bottom_medium ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_bottom_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->faq_item_padding_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->faq_item_padding_left_medium ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_left_medium ) ) ? 'padding-left:' . esc_attr( $settings->faq_item_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->faq_item_padding_right_medium ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_right_medium ) ) ? 'padding-right:' . esc_attr( $settings->faq_item_padding_right_medium ) . 'px;' : '';
			}
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item {
				<?php if ( is_numeric( $settings->faq_item_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->faq_item_margin_medium ); ?>px;
				<?php } ?>
			}
		}
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions<?php echo esc_attr( $id ); ?> .uabb-faq-question-label {
				<?php if ( isset( $settings->font_size_unit_medium ) && '' !== esc_attr( $settings->font_size_unit_medium ) ) { ?>
					font-size: <?php echo esc_attr( $settings->font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->line_height_unit_medium ) && '' !== esc_attr( $settings->line_height_unit_medium ) ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content {
				<?php if ( isset( $settings->content_font_size_unit_medium ) && '' !== esc_attr( $settings->content_font_size_unit_medium ) ) { ?>
					font-size: <?php echo esc_attr( $settings->content_font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->content_line_height_unit_medium ) && '' !== esc_attr( $settings->content_line_height_unit_medium ) ) { ?>
					line-height: <?php echo esc_attr( $settings->content_line_height_unit_medium ); ?>em;
				<?php } ?>
			}
			<?php
		}
		?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

		<?php if ( isset( $settings->row_gap_responsive ) && 'accordion_style' === $settings->layout_style ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item {
				<?php
				if ( isset( $settings->row_gap_responsive ) ) {
					echo ( '' !== esc_attr( $settings->row_gap_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->row_gap_responsive ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->column_gap_responsive ) ) { ?>

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq__layout-grid .uabb-faq-item {
				<?php
					echo ( '' !== esc_attr( $settings->column_gap_responsive ) ) ? 'padding-right:calc(' . esc_attr( $settings->column_gap_responsive ) / 2 . 'px);' : 'padding-right:calc( 10px/2 );';
					echo ( '' !== esc_attr( $settings->column_gap_responsive ) ) ? 'padding-left:calc(' . esc_attr( $settings->column_gap_responsive ) / 2 . 'px);' : 'padding-left:calc( 10px/2 );';
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-wrap {

				<?php echo ( '' !== esc_attr( $settings->column_gap_responsive ) ) ? 'margin-left:calc(-' . esc_attr( $settings->column_gap_responsive ) / 2 . 'px );' : ''; ?>
				<?php echo ( '' !== esc_attr( $settings->column_gap_responsive ) ) ? 'margin-right:calc(-' . esc_attr( $settings->column_gap_responsive ) / 2 . 'px );' : ''; ?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content<?php echo esc_attr( $id ); ?> {
			<?php
			if ( isset( $settings->answers_padding_top_responsive ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_top_responsive ) ) ? 'padding-top:' . esc_attr( $settings->answers_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->answers_padding_bottom_responsive ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_bottom_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->answers_padding_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->answers_padding_left_responsive ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_left_responsive ) ) ? 'padding-left:' . esc_attr( $settings->answers_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->answers_padding_right_responsive ) ) {
				echo ( '' !== esc_attr( $settings->answers_padding_right_responsive ) ) ? 'padding-right:' . esc_attr( $settings->answers_padding_right_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions<?php echo esc_attr( $id ); ?> {
			<?php
			if ( isset( $settings->faq_item_padding_top_responsive ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_top_responsive ) ) ? 'padding-top:' . esc_attr( $settings->faq_item_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->faq_item_padding_bottom_responsive ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_bottom_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->faq_item_padding_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->faq_item_padding_left_responsive ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_left_responsive ) ) ? 'padding-left:' . esc_attr( $settings->faq_item_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->faq_item_padding_right_responsive ) ) {
				echo ( '' !== esc_attr( $settings->faq_item_padding_right_responsive ) ) ? 'padding-right:' . esc_attr( $settings->faq_item_padding_right_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-item {
			<?php if ( is_numeric( $settings->faq_item_margin_responsive ) ) { ?>
				margin-bottom: <?php echo esc_attr( $settings->faq_item_margin_responsive ); ?>px;
			<?php } ?>
		}
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-questions<?php echo esc_attr( $id ); ?> .uabb-faq-question-label {
				<?php if ( isset( $settings->font_size_unit_responsive ) && '' !== esc_attr( $settings->font_size_unit_responsive ) ) { ?>
					font-size: <?php echo esc_attr( $settings->font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->line_height_unit_responsive ) && '' !== esc_attr( $settings->line_height_unit_responsive ) ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-faq-content {
				<?php if ( isset( $settings->content_font_size_unit_responsive ) && '' !== esc_attr( $settings->content_font_size_unit_responsive ) ) { ?>
					font-size: <?php echo esc_attr( $settings->content_font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->content_line_height_unit_responsive ) && '' !== esc_attr( $settings->content_line_height_unit_responsive ) ) { ?>
					line-height: <?php echo esc_attr( $settings->content_line_height_unit_responsive ); ?>em;
				<?php } ?>
			}
			<?php
		}
		?>
	}
<?php } ?>
